<?php

namespace App\Console\Commands;

use App\Models\DeviceGroup;
use Illuminate\Console\Command;

class DeviceSave extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'joydata:device-save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     */
    public function handle()
    {
        $d = DeviceGroup::find(1);
        DeviceGroup::withoutEvents(function () use($d) {
            $d->name = $d->name.'1';
            $d->save();
        });
        dd($d->toArray());
    }
}
