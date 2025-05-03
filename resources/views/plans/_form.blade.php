@csrf
<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $plan->name ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Price</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $plan->price ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Currency</label>
    <input type="text" name="currency" value="{{ old('currency', $plan->currency ?? 'INR') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Max Websites</label>
    <input type="number" name="max_websites" value="{{ old('max_websites', $plan->max_websites ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label>Storage Limit (GB)</label>
    <input type="number" name="storage_limit" value="{{ old('storage_limit', $plan->storage_limit ?? '') }}" class="form-control" required>
</div>
<div class="form-check mb-3">
    <input type="checkbox" name="is_popular" class="form-check-input" {{ old('is_popular', $plan->is_popular ?? false) ? 'checked' : '' }}>
    <label class="form-check-label">Is Popular?</label>
</div>
<button type="submit" class="btn btn-success">Save</button>
