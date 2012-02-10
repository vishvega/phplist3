<?php

# generate text content
$msgid = sprintf('%d',$_GET['id']);
$messagedata = loadMessageData($msgid);

if (preg_match('/\[URL:(.+)\]/',$messagedata['message'],$regs)) {
  $content = fetchUrl($regs[1]);
#  $textversion = 'Fetched '.$regs[1];
  $textversion = HTML2Text($content);
} else {
  $textversion = HTML2Text($messagedata['message']);
}
setMessageData($msgid,'textmessage',$textversion);

## convert to feedback in the textarea
$textversion = trim($textversion);
$textversion = htmlspecialchars($textversion);
$textversion = preg_replace("/\n/","\\n",$textversion);

$status =  '<script type="text/javascript">

$("#textmessage").html("'.$textversion.'");


</script>
';

