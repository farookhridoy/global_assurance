<?php
if(is_array($params))
{
    $szParams = count($params);
    if($szParams)
    {
        if(strtolower($params[$szParams - 2])=='page')
            $page = $params[$szParams - 1];    
    }
}
?>