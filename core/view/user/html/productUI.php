<main>
    <div class="product_page">
        <h1>{{ $this->pageData["product"]["name"] }}</h1>
        <p>{{ $this->pageData["product"]["full_name"] }}</p>
        <p>Сделано в России: {{ $this->pageData["product"]["russian_product"] }}</p>
        <div class="producd_data">
            <div class="item">
                <h2>Описание</h2>
                <p>{{ $this->pageData["product"]["description"] }}</p>
            </div>
            <div class="item">
                <h2>О продукте</h2>
                <p>Категория: {{ $this->pageData["product"]["category"] }}</p>
                <p>Ссылка на продукт: <a href="{{ $this->pageData['product']['product_url'] }}">{{ $this->pageData["product"]["product_url"] }}</a></p>
                <p>Заказчики продукта: {{ $this->pageData["product"]["name_consumer"] }}</p>
                <p>Инн заказчиков продукта: {{ $this->pageData["product"]["inn_organization_consumer"] }}</p>
                <p>Эффект: {{ $this->pageData["product"]["effect"] }}</p>
                <p>Наименование варианта использования: {{ $this->pageData["product"]["name_use_option"] }}</p>
            </div>
            <div class="item">
                <h2>Область применения</h2>
                <span>Область применения: {{ $this->pageData["product"]["scope_application"] }}</span>
                <span>Предмет область AI: {{ $this->pageData["product"]["subject_area_AI"] }}</span>
                <span>Процесс: {{ $this->pageData["product"]["process"] }}</span>
                <span>Название проекта: {{ $this->pageData["product"]["project_name"] }}</span>
            </div>
        </div>
    </div>
</main>