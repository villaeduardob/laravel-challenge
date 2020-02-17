<div class="panel-body">
    <div class="form-group">
        <label for="">Título<font style="color:#900;font-weight:bold;font-size:20px;">*</font></label>
        <input type="text" id="title" name="title" class="form-control" value="{{ isset($event->title) ? $event->title : old('title') }}">
    </div>

    <div class="form-group">
        <label for="">Descrição</label>
        <textarea name="description" id="description" rows="5" cols="30" class="form-control">{{ isset($event->description) ? $event->description : old('description') }}</textarea>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <label for="">Data Início<font style="color:#900;font-weight:bold;font-size:20px;">*</font></label>
                <input type="text" id="date_start" name="date_start" class="form-control" placeholder="DD/MM/AAAA" value="{{ isset($event->date_start) ? $event->date_start : old('date_start') }}">
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="">Data Término<font style="color:#900;font-weight:bold;font-size:20px;">*</font></label>
                <input type="text" id="date_end" name="date_end" class="form-control" placeholder="DD/MM/AAAA" value="{{ isset($event->date_end) ? $event->date_end : old('date_end') }}">
            </div>
        </div>
    </div>
</div>

<div class="panel-footer text-right">
    <a href="{{ route('admin.events.index') }}" class="btn btn-default">Cancelar</a>
    <button type="submit" class="btn btn-success">Salvar</button>
</div>