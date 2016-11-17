<?php

declare(strict_types = 1);

namespace unreal4u\TelegramBots\Models\Entities;

use Ramsey\Uuid\Uuid;

/**
 * @Entity
 * @Table(name="Monitors")
 */
class Monitors
{
    const TYPE_WEBHOOK = 0;

    const TYPE_SELFCHECK = 1;

    /**
     * @var int
     * @Id
     * @Column(type="uuid_binary")
     * @GeneratedValue(strategy="CUSTOM")
     * @CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * @var int
     * @Column(type="integer")
     */
    protected $chatId;

    /**
     * @var int
     * @Column(type="integer")
     */
    protected $userId;

    /**
     * @var string
     * @Column(type="uuid")
     */
    protected $notifyUrl;

    /**
     * @var int
     * @Column(type="smallint", options={"unsigned"=true})
     */
    protected $type = self::TYPE_WEBHOOK;

    /**
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $monitorAPIKey;

    /**
     * @param int $chatId
     * @return Monitors
     */
    public function setChatId($chatId): Monitors
    {
        $this->chatId = $chatId;
        return $this;
    }

    /**
     * @param int $userId
     * @return Monitors
     */
    public function setUserId($userId): Monitors
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param string $notifyUrl
     * @return Monitors
     */
    public function setNotifyUrl($notifyUrl): Monitors
    {
        if (empty($notifyUrl)) {
            $notifyUrl = Uuid::uuid4()->toString();
        }
        $this->notifyUrl = $notifyUrl;
        return $this;
    }

    /**
     * @param int $type
     * @return Monitors
     */
    public function setType($type): Monitors
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $monitorAPIKey
     * @return Monitors
     */
    public function setMonitorAPIKey($monitorAPIKey): Monitors
    {
        $this->monitorAPIKey = $monitorAPIKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getChatId(): int
    {
        return $this->chatId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): string
    {
        return $this->notifyUrl;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getMonitorAPIKey(): string
    {
        return $this->monitorAPIKey;
    }
}