<?php

namespace App\View\Components;

use App\Complaint;
use Illuminate\View\Component;

class ComplaintStatus extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $pending = Complaint::where('status', 'pending')->count();
        $onProcess = Complaint::where('status', 'on process')->count();
        $complete = Complaint::where('status', 'complete')->count();
        return view('components.complaint-status', [
            'pending' => $pending,
            'onProcess' => $onProcess,
            'complete' => $complete
        ]);
    }
}
