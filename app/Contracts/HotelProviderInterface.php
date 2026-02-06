<?php

namespace App\Contracts;

/**
 * هذا الواجهة (Interface) تضمن أن كل مزود بيانات (Provider) 
 * يلتزم بنفس القواعد، مما يسهل إضافة مزودين جدد مستقبلاً.
 */
interface HotelProviderInterface
{
    /**
     * جلب البيانات من الـ API
     */
    public function fetchRawData(): array;

    /**
     * تحويل البيانات لشكل موحد يفهمه السيستم بتاعنا
     */
    public function formatData(array $rawData): array;
}