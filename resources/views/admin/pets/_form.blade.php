@csrf

<style>
    .form-control-pet {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .invalid {
        border: 2px solid #dc3545 !important;
        background-color: #fff8f8;
    }
    .error-msg {
        color: #dc3545;
        font-size: 14px;
        display: block;
        margin-top: 5px;
    }
    .alert-danger-box {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 12px;
        border-radius: 4px;
        margin-bottom: 20px;
    }
</style>

@if ($errors->any())
    <div class="alert-danger-box">
        <strong>Исправьте ошибки в форме ({{ $errors->count() }})</strong>
    </div>
@endif

<div style="margin-bottom: 15px;">
    <label for="title" style="display: block; margin-bottom: 5px;"><strong>Кличка питомца:</strong></label>
    <input type="text" id="title" name="title" 
           value="{{ old('title', $pet->title ?? '') }}" 
           @class(['form-control-pet', 'invalid' => $errors->has('title')])>
    @error('title') <span class="error-msg">{{ $message }}</span> @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="breed" style="display: block; margin-bottom: 5px;"><strong>Порода:</strong></label>
    <input type="text" id="breed" name="breed" 
           value="{{ old('breed', $pet->breed ?? '') }}" 
           @class(['form-control-pet', 'invalid' => $errors->has('breed')])>
    @error('breed') <span class="error-msg">{{ $message }}</span> @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="age" style="display: block; margin-bottom: 5px;"><strong>Возраст:</strong></label>
    <input type="number" id="age" name="age" 
           value="{{ old('age', $pet->age ?? '') }}" 
           @class(['form-control-pet', 'invalid' => $errors->has('age')])>
    @error('age') <span class="error-msg">{{ $message }}</span> @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="price" style="display: block; margin-bottom: 5px;"><strong>Цена:</strong></label>
    <input type="number" id="price" name="price" 
           value="{{ old('price', $pet->price ?? '') }}" 
           @class(['form-control-pet', 'invalid' => $errors->has('price')])>
    @error('price') <span class="error-msg">{{ $message }}</span> @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="owner_id" style="display: block; margin-bottom: 5px;"><strong>Владелец:</strong></label>
    <select id="owner_id" name="owner_id" @class(['form-control-pet', 'invalid' => $errors->has('owner_id')])>
        <option value="">Выберите владельца</option>
        @foreach($owners as $owner)
            <option value="{{ $owner->id }}" @selected(old('owner_id', $pet->owner_id ?? '') == $owner->id)>
                {{ $owner->name }}
            </option>
        @endforeach
    </select>
    @error('owner_id') <span class="error-msg">{{ $message }}</span> @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="description" style="display: block; margin-bottom: 5px;"><strong>Описание:</strong></label>
    <textarea id="description" name="description" rows="4" 
              @class(['form-control-pet', 'invalid' => $errors->has('description')])>{{ old('description', $pet->description ?? '') }}</textarea>
    @error('description') <span class="error-msg">{{ $message }}</span> @enderror
</div>

<div style="margin-bottom: 15px;">
    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
        <input type="checkbox" name="is_vaccinated" value="1" 
               @checked(old('is_vaccinated', $pet->is_vaccinated ?? true))>
        <strong>Питомец здоров</strong>
    </label>
    @error('is_vaccinated') <span class="error-msg">{{ $message }}</span> @enderror
</div>

<div style="margin-bottom: 15px;">
    <label style="display: block; margin-bottom: 5px;"><strong>Текущая обложка:</strong></label>
    <div style="margin-top: 5px;">
        <img src="{{ isset($pet) ? $pet->cover_url : asset('images/no-cover.png') }}" alt="Обложка" style="width: 120px; height: auto; border: 1px solid #ccc; padding: 4px; border-radius: 4px; object-fit: cover;">
    </div>
</div>

@if(isset($pet) && $pet->cover)
    <div style="margin-bottom: 15px;">
        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
            <input type="checkbox" name="remove_cover" value="1">
            <strong>Удалить картинку</strong>
        </label>
        @error('remove_cover') <span class="error-msg">{{ $message }}</span> @enderror
    </div>
@endif

<div style="margin-bottom: 20px;">
    <label for="cover" style="display: block; margin-bottom: 5px;"><strong>Обложка питомца:</strong></label>
    <input type="file" name="cover" id="cover" @class(['form-control-pet', 'invalid' => $errors->has('cover')]) style="padding: 5px;">
    @error('cover') <span class="error-msg">{{ $message }}</span> @enderror
</div>
<div style="margin-bottom: 20px;">
    <label for="attachment" style="display: block; margin-bottom: 5px;"><strong>Документ к записи (PDF):</strong></label>
    <input type="file" name="attachment" id="attachment" @class(['form-control-pet', 'invalid' => $errors->has('attachment')]) style="padding: 5px;">
    @error('attachment') <span class="error-msg">{{ $message }}</span> @enderror
</div>

<button type="submit" style="padding: 10px 20px; background-color: #28a745; color: #fff; border: none; cursor: pointer; border-radius: 4px; font-weight: bold;">Сохранить</button>
