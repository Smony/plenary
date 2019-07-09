## FAQ
    public function sendMail($vars)
    {
        Mail::send('kitsoft.plenary::mail.county', $vars, function ($message) {
            $message->from('dev.symonchuk@gmail.com', 'October2');
            $message->to('vova.symonchuk@gmail.com')->cc('v.symonchuk@kitsoft.kiev.ua');
            $message->subject('This is a test');

        });
    }
