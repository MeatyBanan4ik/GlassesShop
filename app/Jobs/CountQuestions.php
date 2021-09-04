<?php

namespace App\Jobs;

use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CountQuestions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $prod_count = Question::where('type', '=', 'product')->where('answer', '=', NULL)->count();
        $phone_count= Question::where('type', '=', 'phone')->where('answer', '=', NULL)->count();
        $all_count = Question::where('type', '=', 'all')->where('answer', '=', NULL)->count();
        return json_encode(compact('prod_count', 'all_count', 'phone_count'));
    }
}
