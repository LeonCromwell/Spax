<?php
class CountDown
{
    private $minutes;
    private $countDownBtnId;
    private $countDownContainer;


    public function setMinutes($minutes)
    {
        $this->minutes = $minutes;
    }
    public function getMinutes()
    {
        return $this->minutes;
    }
    public function setCountDownBtnId($countDownBtnId)
    {
        $this->countDownBtnId = $countDownBtnId;
    }
    public function getCountDownBtnId()
    {
        return $this->countDownBtnId;
    }
    public function setCountDownContainer($countDownContainer)
    {
        $this->countDownContainer = $countDownContainer;
    }
    public function getCountDownContainer()
    {
        return $this->countDownContainer;
    }


    public function CountDown()
    {
        $minutes = $this->getMinutes();
        $countDownBtnId = $this->getCountDownBtnId();
        $countDownContainer = $this->getCountDownContainer();
        echo <<<EOD
                        <script type="text/javascript">
                            var duration = $minutes * 60 * 1000; 
                            var countDownBtn = document.getElementById("$countDownBtnId");
                            var x;
                            
                            countDownBtn.addEventListener("click", e => {
                            e.preventDefault();

                            var startTime = new Date().getTime();
                            if(x) clearInterval(x);
                            x = setInterval(function() {
                                var now = new Date().getTime();
                                var distance = startTime + duration - now;
                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                document.getElementById("$countDownContainer").innerHTML = minutes + "m " + seconds + "s ";
                                if (distance <= 0) {
                                    clearInterval(x);
                                    document.getElementById("$countDownContainer").innerHTML = "Hết thời gian!";
                                    document.getElementById("$countDownContainer").setAttribute("class", "text-danger");
                                }
                            }, 1000);
                        });
                        </script>
                        EOD;
        return 0;
    }
}
?>