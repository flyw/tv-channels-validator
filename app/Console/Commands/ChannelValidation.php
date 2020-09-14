<?php

namespace App\Console\Commands;

use App\Jobs\ChannelValidationJob;
use App\Models\Channel;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ChannelValidation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'channel:validation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Channel Validation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $date = Carbon::now("Asia/Shanghai")->subDays(10)->format("Y-m-d H:i:s");
        Channel::where("scheme", "like", "http%")
            ->where("created_at", "<", $date)
            ->delete();
        foreach (Channel::where("scheme", "like", "http%")->cursor() as $channel) {
            ChannelValidationJob::dispatch($channel);
        }
    }
}
