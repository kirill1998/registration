<?php


function sess_open(  $sess_path, $sess_name)
{
    echo'Сессия открыта<br />';
    echo'Путь сессии: '.$sess_path.'<br />';
    echo'Имя сессии: '.$sess_name.'<br />';
    return true;
}
function sess_close()
{
    echo'Сессия закрыта<br />';
    return true;
}
function sess_read(  $sess_id)
{
    echo'Сессия прочитана<br />';
    echo'ID сессии: '.$sess_id.'<br />';
    return '';
}
function sess_write(  $sess_id,  $data)
{
    echo'Сессия записана<br />';
    echo'ID сессии: '.$sess_id.'<br />';
    echo'Данные: '.$data.'<br />';
    return true;
}
function sess_destroy( $sess_id)
{
    echo'Сессия уничтожена<br />';
    return true;
}
function sess_gb(  $sess_maxlifetime)
{
    echo'Запущен сборщик мусора<br />';
    echo'Время жизни сессии: '.$sess_maxlifetime.'<br />';
    return true;
}
// Здесь задаём свои обработчики, описанные выше:
session_set_save_handler('sess_open',
    'sess_close',
    'sess_read',
    'sess_write',
    'sess_destroy',
    'sess_gb' );
/*
session_start();
$_SESSION['alpha'] = 'mysession';
session_write_close();
*/