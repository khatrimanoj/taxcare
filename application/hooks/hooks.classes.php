<?php defined('BASEPATH') OR exit('No direct script access allowed');
class ProfilerHandler
{
    function EnableProfiler()
    {
        $CI = &get_instance();
        $CI->output->enable_profiler( config_item('enable_hooks') );
    }
}