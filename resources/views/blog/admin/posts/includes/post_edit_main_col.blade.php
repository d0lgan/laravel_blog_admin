<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#maindata" data-toggle="tab" role="tab">Основные данные</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#adddata" data-toggle="tab" role="tab">Доп. данные</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="title" name="title" value="{{ $item->title }}" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="content_raw">Статья</label>
                            <textarea name="content_raw" id="content_raw" class="form-control" rows="15">
                                {{ old('content_raw', $item->content_raw) }}
                            </textarea>
                        </div>
                    </div>
                    <div class="tab-pane" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select name="category_id" id="category_id" class="form-control" placeholder="Выберите категорию" required>
                                @foreach($categoryList as $categoryOption)
                                    <option
                                        value="{{ $categoryOption->id }}"
                                        @if($categoryOption->id == $item->category_id) selected @endif>
                                        {{ $categoryOption->id_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="slug">Идентификатор</label>
                            <input name="slug" type="text" id="slug" class="form-control" value="{{ $item->slug }}">
                        </div>
                        <div class="form-group">
                            <label for="excerpt" class="excerpt">Выдержка</label>
                            <textarea name="excerpt" id="excerpt" class="form-control" rows="3">
                                {{ old('excerpt', $item->excerpt) }}
                            </textarea>
                        </div>

                        <div class="form-check">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published"
                                   class="form-check-input"
                                   value="1"
                                   @if($item->is_published)
                                       checked="checked"
                                   @endif
                            >
                            <label for="is_published" class="form-check-label">Опубликовано</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
