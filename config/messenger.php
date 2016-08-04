<?php

return [

    'user_model' => App\User::class,

    'message_model' => Cmgmyr\Messenger\Models\Message::class,

    'participant_model' => Cmgmyr\Messenger\Models\Participant::class,

    'thread_model' => Cmgmyr\Messenger\Models\Thread::class,

    /**
     * Define custom database table names.
     */
    'messages_table' => 'messenger_messages',

    'participants_table' => 'messenger_participants',

    'threads_table' => 'messenger_threads',
];
