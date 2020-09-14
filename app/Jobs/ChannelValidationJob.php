<?php

namespace App\Jobs;

use App\Models\Channel;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ChannelValidationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    var $channel = null;

    /**
     * Create a new job instance.
     *
     * @param Channel $channel
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $client = new Client();
        try {
            $client->request("GET",  $this->channel->url, ['timeout' => 10]);
            $this->channel->valid = 1;
            $this->channel->check_count = $this->channel->check_count +1;
            $this->channel->valid_count = $this->channel->valid_count +1;
            $this->channel->created_at = Carbon::now();
            $this->channel->save();
            Log::info("success: " .$this->channel->url);
        }
        catch (\Exception $e) {
            $this->channel->valid = 0;
            $this->channel->check_count = $this->channel->check_count +1;
            $this->channel->save();
            Log::info("failed: ". $this->channel->url);
        }
    }
}
