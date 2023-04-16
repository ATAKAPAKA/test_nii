<main>
    <div class="company_page">
        <h1>{{$this->pageData["company"]["name"]}}</h1>
        <p>{{$this->pageData["company"]["full_name"]}}</з>
        <p>{{$this->pageData["company"]["status"]}}</з>
        <h2>Описание</h2>
        <div class="company_p">
            {{$this->pageData["company"]["description"] }}
        </div>
        <h2>Профиль</h2>
        <div class="company_p company_p_profil">
            <div class="item"><span>Директор: {{$this->pageData["company"]["director"] }}</span></div>
            <div class="item"><span>Юридический адрес: {{$this->pageData["company"]["address"] }}</span></div>
            <div class="item"><span>Выручка: {{ $this->pageData["company"]["revenue"] }} ₽</span></div>
            <div class="item"><span>Доход: {{ $this->pageData["company"]["profit"] }} ₽</span></div>
            <div class="item"><span>Налоги: {{ $this->pageData["company"]["taxes"] }} ₽</span></div>
            <div class="item"><span>ИНН: {{$this->pageData["company"]["inn"] }}</span></div>
            <div class="item"><span>ОГРН: {{$this->pageData["company"]["ogrn"] }}</span></div>
            <div class="item"><span>Сотрудников: {{ $this->pageData["company"]["average_employees"] }}</span></div>
            <div class="item"><span>Размер: {{ $this->pageData["company"]["size"] }}</span></div>
        </div>
        <h2>Контакты</h2>
        <div class="cimpany_p company_p_contacts">
            <div class="item"><span>Сайт компании: <a href="{{ $this->pageData['company']['website'] }}">{{ $this->pageData["company"]["website"] }}</a></span></div>
            <div class="item"><span>Email: <a href="mailto:{{ $this->pageData['company']['email'] }}">{{ $this->pageData["company"]["email"] }}</a></span></div>
            <div class="item"><span>Телефон: {{ $this->pageData["company"]["phone"] }}</span></div>
        </div>
        <h2>Вид деятельности</h2>
        <div class="company_p company_p_activ">
            <span>Основной</span>
            <span>{{ $this->pageData["company"]["main_activity_code"] }}({{ $this->pageData["company"]["main_activity"] }})</span>
            <span>Дополнительный</span>
            <span class="a_activ">{{ $this->pageData["company"]["additional_activity"] }}</span>
        </div>
        <h2>Продукты компании</h2>
        <div class="company_p company_p_products">
            <? foreach ($this->pageData["products"] as $item) { ?>
                <div class="product">
                    <div class="title">
                        <h3><a href="/product/{{$item['id']}}">{{$item["name"]}}</a></h3>
                    </div>
                    <div class="description">{{$item['description']}}</div>
                </div>
            <? } ?>
        </div>
    </div>
</main>