<main>
    <h1>{{$this->title }}</h1>
    <? for ($i = 0; $i < count($this->pageData); $i++) { ?>
        <div class="company">
            <h2 class="title"><a href="/company/{{$this->pageData[$i]['id']}}">{{$this->pageData[$i]["name"]}}</a></h2>
            <div class="company_data">
                <div class="dirname"><span>Директор: {{$this->pageData[$i]["director"] }}</span></div>
                <div class="address"><span>Адрес: {{$this->pageData[$i]["address"] }}</span></div>
                <div class="inn"><span>ИНН: {{$this->pageData[$i]["inn"] }}</span></div>
                <div class="ogrn"><span>ОГРН: {{$this->pageData[$i]["ogrn"] }}</span></div>
                <div class="profit"><span>Прибыль: {{ $this->pageData[$i]["profit"] }} ₽</span></div>
            </div>
        </div>
    <? } ?>
</main>