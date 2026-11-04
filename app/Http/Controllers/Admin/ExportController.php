<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\McqAttempt;
use App\Models\McqQuestion;
use App\Models\QuizAttempt;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    /**
     * Export all quiz attempts as CSV.
     */
    public function quiz(): StreamedResponse
    {
        return $this->streamCsv('nilai-quiz-mencocokkan', QuizAttempt::query());
    }

    /**
     * Export all multiple-choice attempts as CSV.
     */
    public function soal(): StreamedResponse
    {
        return $this->streamCsv('nilai-soal-pilihan-ganda', McqAttempt::query(), withLevel: true);
    }

    /**
     * Stream the attempts of the given query as a CSV download.
     *
     * @param  Builder<QuizAttempt|McqAttempt>  $query
     */
    private function streamCsv(string $name, Builder $query, bool $withLevel = false): StreamedResponse
    {
        $filename = $name.'-'.now()->format('Ymd-His').'.csv';

        return response()->streamDownload(function () use ($query, $withLevel) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, $withLevel
                ? ['Nama', 'Email', 'Skor', 'Total', 'Level', 'Nilai (%)', 'Waktu']
                : ['Nama', 'Email', 'Skor', 'Total', 'Nilai (%)', 'Waktu']);

            $query->with('user:id,name,email')->latest()->chunk(200, function ($attempts) use ($out, $withLevel) {
                foreach ($attempts as $attempt) {
                    $row = [
                        $this->sanitize($attempt->user->name),
                        $this->sanitize($attempt->user->email),
                        $attempt->score,
                        $attempt->total,
                    ];

                    if ($withLevel) {
                        $row[] = $attempt->difficulty !== null
                            ? (McqQuestion::DIFFICULTIES[$attempt->difficulty] ?? $attempt->difficulty)
                            : 'Semua level';
                    }

                    $row[] = $attempt->total > 0 ? round($attempt->score / $attempt->total * 100) : 0;
                    $row[] = $attempt->created_at->format('Y-m-d H:i');

                    fputcsv($out, $row);
                }
            });

            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /**
     * Neutralise spreadsheet formula injection in user-supplied cells.
     */
    private function sanitize(string $value): string
    {
        return preg_match('/^[=+\-@\t\r]/', $value) ? "'".$value : $value;
    }
}
