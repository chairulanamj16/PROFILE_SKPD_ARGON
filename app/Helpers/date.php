<?php
// app/helpers.php
function dateFormat($tanggal)
{
    return \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('D MMMM Y');
}
