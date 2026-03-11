@extends('admin.master')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* --- SEUS ESTILOS ORIGINAIS (PRESERVADOS) --- */
        .select2-container--default .select2-selection--single {
            height: 58px !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 0.5rem !important;
            display: flex !important;
            align-items: center !important;
            background-color: #fff !important;
        }

        .select2-selection__rendered {
            line-height: 58px !important;
            padding-left: 15px !important;
            color: #334155 !important;
            font-weight: 700;
        }

        .select2-selection__arrow {
            height: 58px !important;
        }

        .admin-dark .select2-container--default .select2-selection--single {
            background-color: #1e293b !important;
            border-color: #334155 !important;
        }

        .admin-dark .select2-selection__rendered {
            color: #f1f5f9 !important;
        }

        .admin-dark .select2-dropdown {
            background-color: #1e293b !important;
            border-color: #475569 !important;
            color: #f1f5f9 !important;
        }

        .admin-dark .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: white !important;
        }

        .admin-dark .select2-results__option {
            background-color: #1e293b;
            color: #f1f5f9;
        }

        .admin-dark .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #3b82f6 !important;
            color: #ffffff !important;
        }

        .ck-editor__editable_inline {
            min-height: 500px;
            border: 1px solid #cbd5e1 !important;
            border-bottom-left-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
        }

        .ck-toolbar {
            border: 1px solid #cbd5e1 !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
            background-color: #f8fafc !important;
        }

        .admin-dark .ck-editor__editable_inline {
            background-color: #1e293b !important;
            color: white !important;
            border-color: #334155 !important;
        }

        .admin-dark .ck-toolbar {
            background-color: #0f172a !important;
            border-color: #334155 !important;
        }

        /* Estilo rápido para o input de arquivo */
        input[type="file"]::file-selector-button {
            background-color: #3b82f6;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 10px;
            font-weight: 900;
            margin-right: 15px;
        }
    </style>
@endpush

@section('content')
    <div class="p-6 lg:p-10 space-y-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-[1000] text-slate-800 dark:text-white uppercase tracking-tighter">Nova Notícia</h2>
                <p class="text-sm text-slate-500 font-medium">Portal Pebas 40º • Redação</p>
            </div>
            <a href="{{ route('admin.posts.index') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 rounded-lg font-black uppercase tracking-widest text-[10px] hover:bg-slate-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>

        {{-- Alerta Global de Erros --}}
        @if ($errors->any())
            <div class="p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-r-xl">
                <p class="text-xs font-black text-red-800 dark:text-red-400 uppercase tracking-widest mb-2">Ops! Corrija os
                    erros abaixo:</p>
                <ul class="text-xs text-red-700 dark:text-red-400 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-20">
            @csrf

            {{-- Coluna Principal --}}
            <div class="lg:col-span-2 space-y-8">
                <div
                    class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-8 lg:p-10 space-y-8">

                    {{-- Chapéu --}}
                    <div>
                        <label
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest ml-1">Chapéu
                            / Anti-título</label>
                        <input type="text" name="eyebrow" value="{{ old('eyebrow') }}" placeholder="Ex: ECONOMIA"
                            class="w-full px-5 py-4 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 rounded-lg focus:ring-0 focus:outline-none focus:border-slate-400 dark:focus:border-slate-500 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400 transition-all shadow-sm">
                    </div>

                    {{-- Título --}}
                    <div>
                        <label
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest ml-1">
                            Título Principal @error('title')
                                <span class="text-red-500">*</span>
                            @enderror
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            placeholder="Escreva um título chamativo..."
                            class="w-full px-5 py-4 bg-white dark:bg-slate-800 border @error('title') border-red-500 @else border-slate-300 dark:border-slate-700 @enderror rounded-lg focus:ring-0 focus:outline-none focus:border-slate-400 dark:focus:border-slate-500 text-base text-slate-900 dark:text-white transition-all font-bold shadow-sm">
                        @error('title')
                            <p class="text-[10px] text-red-500 font-bold mt-1 uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Conteúdo --}}
                    <div>
                        <label
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest ml-1">
                            Conteúdo Completo @error('content')
                                <span class="text-red-500">*</span>
                            @enderror
                        </label>
                        <div
                            class="ck-content-wrapper shadow-sm @error('content') border border-red-500 rounded-lg @enderror">
                            <textarea name="content" id="editor">{{ old('content') }}</textarea>
                        </div>
                        @error('content')
                            <p class="text-[10px] text-red-500 font-bold mt-1 uppercase">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Coluna Lateral --}}
            <div class="space-y-8">

                {{-- Bloco Imagem de Capa (NOVO) --}}
                <div
                    class="bg-white dark:bg-slate-900 rounded-2xl border @error('image') border-red-500 @else border-slate-200 dark:border-slate-800 @enderror shadow-sm p-8 space-y-6">
                    <h3
                        class="text-[11px] font-[1000] uppercase tracking-[0.2em] text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-4">
                        Capa da Matéria</h3>
                    <div>
                        <label
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest ml-1">Selecione
                            a Imagem</label>
                        <input type="file" name="image" accept="image/*" required
                            class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-dashed border-slate-300 dark:border-slate-700 rounded-xl text-xs font-bold text-slate-400">
                        @error('image')
                            <p class="text-[10px] text-red-500 font-bold mt-2 uppercase">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Bloco Status --}}
                <div
                    class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-8 space-y-6">
                    <h3
                        class="text-[11px] font-[1000] uppercase tracking-[0.2em] text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-4">
                        Status</h3>
                    <div>
                        <select name="status" class="js-example-basic-single w-full">
                            <option value="postado" {{ old('status') == 'postado' ? 'selected' : '' }}>🚀 Publicado</option>
                            <option value="rascunho" {{ old('status') == 'rascunho' ? 'selected' : '' }}>💾 Rascunho
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Bloco Classificação --}}
                <div
                    class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-8 space-y-6">
                    <h3
                        class="text-[11px] font-[1000] uppercase tracking-[0.2em] text-slate-800 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-4">
                        Classificação</h3>

                    {{-- Categoria --}}
                    <div class="w-full">
                        <label
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest ml-1">Categoria
                            Principal</label>
                        <select name="category_id" required class="js-example-basic-single w-full">
                            <option value="">Selecione...</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ strtoupper($cat->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-[10px] text-red-500 font-bold mt-1 uppercase">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Estado --}}
                    <div class="w-full">
                        <label
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest ml-1">Estado</label>
                        <select name="state_id" id="state_id" class="js-example-basic-single w-full">
                            <option value="">Selecione...</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>
                                    {{ $state->abbr }} - {{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Cidade --}}
                    <div class="w-full">
                        <label
                            class="text-[10px] font-black text-slate-500 dark:text-slate-400 mb-2 block uppercase tracking-widest ml-1">Cidade</label>
                        <select name="city_id" id="city_id" class="js-example-basic-single w-full">
                            <option value="">Selecione a Cidade</option>
                        </select>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-5 bg-blue-600 text-white rounded-xl font-black uppercase tracking-[0.25em] text-sm shadow-xl shadow-blue-500/20 hover:bg-blue-700 transition-all hover:-translate-y-1">
                    Publicar Matéria
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializa o Select2
            $('.js-example-basic-single').select2({
                width: '100%',
                language: {
                    noResults: () => "Nenhum resultado encontrado"
                }
            });

            // Lógica de Cidades (Ajax)
            $('#state_id').on('change', function() {
                const stateId = $(this).val();
                const citySelect = $('#city_id');
                citySelect.html('<option value="">Carregando...</option>').trigger('change');

                if (stateId) {
                    $.ajax({
                        url: "{{ route('admin.get-cities', ['state_id' => ':id']) }}".replace(
                            ':id', stateId),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            citySelect.html('<option value="">Selecione a Cidade</option>');
                            $.each(data, function(key, city) {
                                citySelect.append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });
                            citySelect.trigger('change');
                        }
                    });
                }
            });

            // CKEditor
            const editorElement = document.querySelector('#editor');
            if (editorElement) {
                ClassicEditor.create(editorElement, {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                        'blockQuote', 'insertTable', 'undo', 'redo'
                    ]
                }).then(editor => {
                    editor.editing.view.change(writer => {
                        writer.setStyle('min-height', '500px', editor.editing.view.document
                        .getRoot());
                    });
                });
            }
        });
    </script>
@endpush
