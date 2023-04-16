<main>
    <h1><? echo $this->title  ?></h1>
    <? for ($i = 0; $i < count($this->pageData); $i++) { ?>
        <div class="company">
            <h2 class="title"><a href="/company/<? echo $this->pageData[$i]['id'] ?>"><? echo $this->pageData[$i]["name"] ?></a></h2>
            <div class="company_data">
                <div class="dirname"><span>Директор: <? echo $this->pageData[$i]["director"]  ?></span></div>
                <div class="address"><span>Адрес: <? echo $this->pageData[$i]["address"]  ?></span></div>
                <div class="inn"><span>ИНН: <? echo $this->pageData[$i]["inn"]  ?></span></div>
                <div class="ogrn"><span>ОГРН: <? echo $this->pageData[$i]["ogrn"]  ?></span></div>
                <div class="profit"><span>Прибыль: <? echo  $this->pageData[$i]["profit"]  ?> ₽</span></div>
            </div>
        </div>
    <? } ?>
</main>