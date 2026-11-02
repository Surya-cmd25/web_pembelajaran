<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\McqAttempt;
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
        return $this->streamCsv('nilai-soal-pilihan-ganda', McqAttempt::query());
    }

    /**
     * Stream the attempts of the given query as a CSV download.
     *
     * @param  Builder<QuizAttempt|McqAttempt>  $query
     */
    private function streamCsv(string $name, Builder $query): StreamedResponse
    {
        $filename = $name.'-'.now()->format('Ymd-His').'.csv';

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, ['Nama', 'Email', 'Skor', 'Total', 'Nilai (%)', 'Waktu']);

            $query->with('user:id,name,email')->latest()->chunk(200, function ($attempts) use ($out) {
                foreach ($attempts as $attempt) {
                    fputcsv($out, [
                        $this->sanitize($attempt->user->name),
                        $this->sanitize($attempt->user->email),
                        $attempt->score,
                        $attempt->total,
                        $attempt->total > 0 ? round($attempt->score / $attempt->total * 100) : 0,
                        $attempt->created_at->format('Y-m-d H:i'),
                    ]);
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
