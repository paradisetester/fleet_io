<?php

namespace App\Traits;
use App\Models\V1\OtpVerification;
use Mail;
use DateTime;

trait EmailTrait {
    public function sendEmailOTP($email = null,$name = null)
    {
    	if (!$email) {
    		return 'empty';
    	}
        
    	OtpVerification::where('email', $email)->where('otp_for', 'email')->where('otp_status', 0)->delete();
    	$otp_code = rand(000000, 999999);
    	$otpVerification = new OtpVerification();
    	$otpVerification->email = $email;
    	$otpVerification->otp_code = $otp_code;
    	$otpVerification->time = new DateTime;
    	$otpVerification->otp_for = 'email';
    	$otpVerification->otp_status = 0;
    	$otpVerification->created_at = new DateTime;
    	$otpVerification->created_at = new DateTime;
    	$otpVerification->save();
        $to_name="Fleet";
        $to_mail=$email;
        $data=array('name'=>$name,'body'=>'Your Otp for email verification code is '. $otp_code.'');
        \Mail::send('Email.Otpmail',$data,function($message)use($to_name,$to_mail){
            $message->to($to_mail)->subject('Fleet Email Verification');
        });
    	// $emailBody = 'Your Otp for email verification code is '.$otp_code;    	       
    	// $this->sendEmail($email, 'Fleetio Email OTP '.$otp_code, $emailBody);
    	// return 'Email Send Successfully';
    }

    public function sendPasswordVerificationOtpmail($email = null)
    {
        if (!$email) {
            return 'empty';
        }
        
        OtpVerification::where('email', $email)->where('otp_for', 'email')->where('otp_status', 0)->delete();
        $otp_code = rand(000000, 999999);
        $otpVerification = new OtpVerification();
        $otpVerification->email = $email;
        $otpVerification->otp_code = $otp_code;
        $otpVerification->time = new DateTime;
        $otpVerification->otp_for = 'email';
        $otpVerification->otp_status = 0;
        $otpVerification->created_at = new DateTime;
        $otpVerification->created_at = new DateTime;
        $otpVerification->save();
        $to_name="Fleet";
        $to_mail=$email;
        $data=array('body'=>'Your Otp for email verification code is '. $otp_code.'');
        \Mail::send('Email.EmailPasswordOtpVerification',$data,function($message)use($to_name,$to_mail){
            $message->to($to_mail)->subject('Fleet Email Verification For Password');
        });
    }

    public function send_PlanDetails_Email($data = [])
    {
        if (!$data) {
            return 'empty';
        }
        $to_name="Fleet";
        $to_mail=$data['tenant_email'];
        \Mail::send('Email.PlanOrderDetail',$data,function($message)use($to_name,$to_mail){
            $message->to($to_mail)->subject('Fleet Email For Order Details');
        });
    }
    public function send_PlanUpdateDetail_Email($data = [])
    {
        if (!$data) {
            return 'empty';
        }
        $to_name="Fleet";
        $to_mail=$data['tenant_email'];
        \Mail::send('Email.PlanUpdateOrderDetail',$data,function($message)use($to_name,$to_mail){
            $message->to($to_mail)->subject('Fleet Email For Update Order Details');
        });
    }
    public function verifyEmailOTP($email = null, $otp_code = null)
    {
    	if (empty($otp_code)) {
    		return 'emptyOTP';
    	}
    	if (empty($email)) {
    		return 'emptyEmail';
    	}
    	$otpCode = OtpVerification::where('email', $email)->where('otp_status', 0)->where('otp_code', $otp_code)->where('otp_for', 'email')->get()->first();
    	if (empty($otpCode)) {
    		return 'otpCodeInvalid';
    	}
    	OtpVerification::where('otp_id', $otpCode->otp_id)->update(['otp_status'=>1]);
    	return 'verified';
    }
    public function sendEmail($emailTo = '', $emailSubject = '', $emailBody = '', array $attachments = [], $email_cc = '', $email_bcc = '')
    {
        ini_set('max_execution_time', 600);
        
        $emailFromEmail = env("MAIL_FROM_ADDRESS", "paradisetester@gmail.com");
        $emailFromName = env("MAIL_FROM_NAME", "paradisetester");
        \Mail::send(
            'Email.Index', 
            ['html' => $emailBody], 
            function($message) 
            use($emailTo, $emailSubject, $attachments, $emailFromName, $emailFromEmail, $email_cc, $email_bcc) 
            {
                $message->from($emailFromEmail, $emailFromName)->subject($emailSubject);

                $message->to($emailTo);

                if ($email_cc) {
                    $message->cc(explode(',', $email_cc));
                }
                if ($email_bcc) {
                    $message->cc(explode(',', $email_bcc));
                }
                if (!empty($attachments) &&  is_array($attachments)) {
                    foreach ($attachments as $attachment) {
                        $message->attach($attachment);
                    }
                }        
            }
        );
    }
}