<?php
$file = file_get_contents('DATA/chat.json');
/*
    userID: ID пользователя, который отправил сообщение
    date: время сообщения в формате "Час:Мин"
    message: текст сообщения
*/
$chatMessages = json_decode($file, true);

function saveChatData(int $uid, string $message): void {
    global $chatMessages;
    $chatMessages[] = ['userID'=>$uid, 'date'=>date('H:i'), 'message' => $message];
    
    file_put_contents('DATA/chat.json', json_encode($chatMessages));
}