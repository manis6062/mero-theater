<?php

namespace App\Library;

use App\Models\Network;


class FilterRecipient
{
	public $network_list;
    public $totalSMS;

    public function __construct()
    {
        $this->network_list = $this->getNetwork();
    }

    public function getFilteredRecipient($to, $text)
    {
    	return $this->filterNumbers($this->toNumbersToArray($to), $text);
    }

    public function getMessageCost($filteredRecipients, $text)
    {
    	return $this->getTotalSmsCost($this->getNetworkCount($filteredRecipients), $this->countMessageLength($text));
    }

    public function getTotalValidSms()
    {
    	return $this->totalSMS;
    }

    // Convert comma seperated numbers to array
    public function toNumbersToArray($to)
    {
        $to = rtrim(trim($to), ',');
        $toArray = explode(',', $to);

        return $toArray;
    }

    // Count message length



    //Filter number array into valid networks and invalid network array
    public function filterNumbers($numberArray, $text)
    {
        $numbers = [];
        $validNumberCount = 0;
        $invalidNumberCount = 0;

        foreach ($numberArray as $number) {
            $network = $this->checkNetwork($number);

            // counting valid and invalid numbers
            if ($network['valid']) {
                $validNumberCount++;
                $numbers['valid'][$network['network']][] = [
                    'to' => $number,
                    'text' => $text,
                    'network' => $network['network'],
                    'valid' => $network['valid'],
                ];
            } else {
                $invalidNumberCount++;
                $numbers['invalid']['number'][] = [
                    'to' => $number,
                    'text' => $text,
                    'network' => $network['network'],
                    'valid' => $network['valid'],
                    'status_code' => "4006",
                ];
            }
        }
        return $numbers;
    }

    //Check number validitly and to which network it belongs to ie. Ncell, Ntc etc
    public function checkNetwork($number)
    {
        $num= str_replace(' ','',$number);
        $lasttenNumber = substr($num,-10);
        if (strlen($lasttenNumber) != 10) {
            return [
                'network' => "NA",
                'valid' => false
            ];
        }
        $first3Char = substr($lasttenNumber, 0, 3);
        foreach ($this->network_list as $network => $value) {
            if (in_array($first3Char, $value)) {
                return [
                    'network' => $network,
                    'valid' => true
                ];
            }
        }
        return [
            'network' => "NA",
            'valid' => false
        ];
    }

    //Get network list array with its corresponding 3 digit network identification number array
    public function getNetwork()
    {
        $network_list = [];
        $networks = Network::all();
        
        foreach ($networks as $network) {
            $network_list[$network->name] = $this->toNumbersToArray($network->number);
        }
        return $network_list;
    }

    //Get array of respective network count from filtered recipients array
    public function getNetworkCount($filteredRecipients)
    {
        $network_count = [];
        $total = 0;
        foreach ($filteredRecipients as $recipients) {
            foreach ($recipients as $key => $value) {
                $network_count[$key] = count($value);
                $total +=  count($value);
                
            }
        }
        $network_count['total'] = $total;
        return $network_count; 
    }

    //Calculate the total cost of Sms
    public function getTotalSmsCost($network_count, $messageLength)
    {
        $total_sms_cost = 0;
        foreach ($network_count as $network_name => $value) {
            $network = Network::where('name', $network_name)->first();
            if(count($network) > 0) {
                $this->totalSMS += $value * $messageLength;
                $total_sms_cost += $network->cost * $value * $messageLength;
            }
        }
        return $total_sms_cost;
    }

    public function countMessageLength($body, $type='web')
    {

//enter key take 2 characeter so to make it one str_replace used
        $text= str_replace("\r\n", "\n", $body);

        $textCount =  mb_strlen($text,'UTF-8');
        if (!preg_match('/^[\x00-\x7F]*$/', $text)) {
            return ceil($textCount / 70);

        } else {
            return ceil($textCount / 160);

        }
    }
}