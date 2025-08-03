<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:inventory_categories,id',
            'serial_number' => 'required|string|unique:inventory_items,serial_number,' . $this->route('inventory_item')->id,
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'warranty_end_date' => 'nullable|date|after:purchase_date',
            'status' => 'required|in:Available,Assigned,In Repair,Retired',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:employees,id',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Item name is required.',
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'Selected category does not exist.',
            'serial_number.required' => 'Serial number is required.',
            'serial_number.unique' => 'This serial number is already registered to another item.',
            'brand.required' => 'Brand is required.',
            'model.required' => 'Model is required.',
            'purchase_date.required' => 'Purchase date is required.',
            'warranty_end_date.after' => 'Warranty end date must be after purchase date.',
            'status.required' => 'Status is required.',
            'location.required' => 'Location is required.',
            'assigned_to.exists' => 'Selected employee does not exist.',
        ];
    }
}