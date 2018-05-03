<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Registration;
Use Mail;
use DateTime;

class Godisnjica extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:Godisnjica';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Djelatnik ima godišnjicu rada u Duplicu';

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
		$datum = new DateTime('now');
		$datum->modify('+5 days');
		$dan = date_format($datum,'d');
		$mjesec = date_format($datum,'m');
		$godina = date_format($datum,'Y');
		
		$djelatnici = Registration::join('employees','registrations.employee_id', '=', 'employees.id')->select('registrations.*','employees.first_name','employees.last_name')->whereMonth('registrations.datum_prijave', '=', $mjesec)->whereDay('registrations.datum_prijave', '=', $dan)->get();
		
		foreach($djelatnici as $djelatnik) {
			$date1 = new DateTime($djelatnik->datum_prijave); 
			$date2 = new DateTime('now'); 
			$date1->modify('-5 days'); //za godinu
			$interval = $date1->diff($date2); 
			$years = $interval->format('%y'); 
			$dana = $interval->format('%d');
			$dana = $dana + 5;
			$dana =  'za ' . $dana . 'dana';

			if($years == 5 || $years == 10 || $years == 15 || $years == 20) {
			// Send the email to user
				Mail::queue('email.Godisnjica', ['djelatnik' => $djelatnik, 'years' => $years, 'dana' => $dana], function ($mail) use ($djelatnik) {
					$mail->to('uprava@duplico.hr')
						->cc('jelena.juras@duplico.hr')
						->cc('andrea.glivarec@duplico.hr')
						->cc('petrapaola.bockor@duplico.hr')
						->from('info@duplico.hr', 'Duplico')
						->subject('Godišnjica ' . ' rada - ' . $djelatnik->first_name . ' '. $djelatnik->last_name);
				});
			}
		}
		$this->info('Obavijest je poslana!');
    }
}