<?
function experience ($company, $position, $start_date, $end_date,$bullets){
    $html = "   
                <hr>
                <div class='work row'>
                    <div class='company-pos col-lg-4' data-scrollreveal='enter left and move 100px, wait 0.4s'>
                        <span class='accent position'>$position</span> / <span class='company'>$company</span>
                        <div class='date-range caps'>$start_date - $end_date</div>
                    </div>

                    <div class='col-lg-8' data-scrollreveal='enter right and move 100px, wait 0.4s'>
                        <ul>";
    foreach($bullets as $bullet){
        $html .= "
                            <li class='bullet'>$bullet</li>";
    }

    $html .= "          </ul>
                    </div>
                </div>
            ";
    return $html;
}
