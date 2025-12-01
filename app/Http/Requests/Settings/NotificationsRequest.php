<?php

declare(strict_types=1);

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class NotificationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('notifications settings');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'notification_sms_gateway' => 'required|exists:sending_servers,uid,status,1',
            'notification_sender_id'   => 'required',
            'notification_phone'       => 'required',
            'notification_from_name'   => 'required',
            'notification_email'       => 'required|email',
        ];
    }

    /**
     * update custom error message
     */

    /**
     * custom message
     */
    public function messages(): array
    {
        return [
            'notification_sms_gateway.exists' => __('locale.settings.notification_sms_gateway_required'),
        ];
    }
}
