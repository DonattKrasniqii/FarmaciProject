<?php


if(!function_exists('getJiraPriorities')) {
    function getJiraPriorities()
    {
        return ['Highest', 'Medium', 'Low', 'Lowest'];
    }
}

if(!function_exists('getJiraType')) {
    function getJiraTypes()
    {

    }
}

if(!function_exists('motivational_qoute')){
    function motivational_qoute(){

        return collect(['When you arise in the morning think of what a precious privilege it is to be alive to breathe to think, to enjoy,<strong>to love</strong>',
            'The happiness of your life depends upon the quality of your thoughts',
            'Accept whatever comes to you woven in the pattern of <strong>your destiny</strong> for what could more aplty fit <strong>your needs?</strong>',
            'To ensure good health: eat lightly, breathe deeply, live moderately, cultivate <strong>cheerfulness</strong>, and maintain an <strong>interest</strong> in life.'])
            ->random();
    }
}


