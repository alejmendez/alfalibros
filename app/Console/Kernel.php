<?php

namespace alfalibros\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use DB;
use Carbon\Carbon;

use alfalibros\Modules\Base\Model\Compras;
use alfalibros\Modules\Pagina\Model\Venta;
use alfalibros\Modules\Pagina\Model\VentaDetalle;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $compras = Compras::select('sale_id', 'estatus')
                ->where('created_at', '<', Carbon::now()->subHour()->format('Y-m-d H:i:s'))
                ->where('aprobado', 0)
                ->get();
            
            $sale_id = [];

            foreach ($compras as $compra) { 
                $compra->delete();
            }

            $contenido = Carbon::now()->format('Y-m-d H:i:s') . ': ';

            if (!empty($sale_id)) {
                $contenido .= 'Se eliminaron [' . implode(', ', $sale_id) . '] registros.';
            } else {
                $contenido .= 'Sin cambios';
            }

            \Storage::append('log_schedule.txt', $contenido);
        })->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
