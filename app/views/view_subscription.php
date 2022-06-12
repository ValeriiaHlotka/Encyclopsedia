<div class="subscription">
    <h2>Subscription</h2>

    <div class="content_area">

        <?php if (@$data[1]): ?>
        Your plan is "<?php echo $data[2]; ?>"
        <?php else: ?>
        You can choose any of these plans
        <?php endif; ?>
        <section class="plans">
            <div class="plan <?php echo @$data[1] === "1" ? "selected" : "" ?>" data-id="1" data-sum="100"> <a target="_blank" href ="https://www.liqpay.ua/api/3/checkout?data=eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJhbW91bnQiOiIzMCIsImN1cnJlbmN5IjoiVUFIIiwiZGVzY3JpcHRpb24iOiJOaWNlIHRvIG1lZXQgeW91IiwicHVibGljX2tleSI6InNhbmRib3hfaTQ5OTIyMDcwMDk2IiwibGFuZ3VhZ2UiOiJydSJ9&signature=eBAU2QaH2lhTzZ2X4RGS4Wl3YAo=">
                <div class="heading">Nice to meet you</div>
                - 7 days of content access;<br>
                - ability to open 1 entertainment element;
                <div class="price">30 UAH</div>
                </a>
                <?php if (@$data[0] >= 100): ?>
                <a target="_blank" href="https://www.liqpay.ua/api/3/checkout?data=eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJhbW91bnQiOiIxOCIsImN1cnJlbmN5IjoiVUFIIiwiZGVzY3JpcHRpb24iOiJOaWNlIHRvIG1lZXQgeW91IiwicHVibGljX2tleSI6InNhbmRib3hfaTQ5OTIyMDcwMDk2IiwibGFuZ3VhZ2UiOiJydSJ9&signature=6nZRiRfrf5y/pQVRsNPAiHtKDYQ="><button class="discount">Buy with 40% off for 100 points!</button></a>
            <?php endif; ?>
            </div>
            <div class="plan <?php echo @$data[1] === "2" ? "selected" : "" ?>" data-id="2" data-sum="150"> <a target="_blank" href = "https://www.liqpay.ua/api/3/checkout?data=eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJhbW91bnQiOiI1MCIsImN1cnJlbmN5IjoiVUFIIiwiZGVzY3JpcHRpb24iOiJJIG5lZWQgc29tZSBtb3JlIiwicHVibGljX2tleSI6InNhbmRib3hfaTQ5OTIyMDcwMDk2IiwibGFuZ3VhZ2UiOiJydSJ9&signature=by2/GKtbEfGEeqgf8Zln6V3Cais=">
                <div class="heading">I need some more</div>
                - 21 days of content access;<br>
                - ability to open 3 entertainment elements;<br>
                <div class="price">50 UAH</div>
                </a>
                <?php if (@$data[0] >= 150): ?>
                <a target="_blank" href="https://www.liqpay.ua/api/3/checkout?data=eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJhbW91bnQiOiIzMCIsImN1cnJlbmN5IjoiVUFIIiwiZGVzY3JpcHRpb24iOiJJIG5lZWQgc29tZSBtb3JlIiwicHVibGljX2tleSI6InNhbmRib3hfaTQ5OTIyMDcwMDk2IiwibGFuZ3VhZ2UiOiJydSJ9&signature=Q2XeP3h4V9rmFUNMgTZiC+/gb20="><button class="discount">Buy with 40% off for 150 points!</button></a>
                <?php endif; ?>
            </div>
            <div class="plan <?php echo @$data[1] === "3" ? "selected" : "" ?>" data-id="3" data-sum="200"> <a target="_blank" href = "https://www.liqpay.ua/api/3/checkout?data=eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJhbW91bnQiOiIxMzAiLCJjdXJyZW5jeSI6IlVBSCIsImRlc2NyaXB0aW9uIjoiVGhhdGBzIGNhbGxlZCBncmVhdCIsInB1YmxpY19rZXkiOiJzYW5kYm94X2k0OTkyMjA3MDA5NiIsImxhbmd1YWdlIjoicnUifQ==&signature=S7vCtGYg+xRKtCek/CvAao3tBDU=">
                <div class="heading">That`s called great</div>
                - 62 days of content access;<br>
                - ability to open 7 entertainment elements;
                <div class="price">130 UAH</div>
                </a>
                <?php if (@$data[0] >= 200): ?>
                <a target="_blank" href="https://www.liqpay.ua/api/3/checkout?data=eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJhbW91bnQiOiI3OCIsImN1cnJlbmN5IjoiVUFIIiwiZGVzY3JpcHRpb24iOiJUaGF0YHMgY2FsbGVkIGdyZWF0IiwicHVibGljX2tleSI6InNhbmRib3hfaTQ5OTIyMDcwMDk2IiwibGFuZ3VhZ2UiOiJydSJ9&signature=UPGkYJpWCd1NEqfRAFuSw5+l3pQ="><button class="discount">Buy with 40% off for 200 points!</button></a>
                <?php endif; ?>
            </div>
            <div class="plan <?php echo @$data[1] === "4" ? "selected" : "" ?>" data-id="4" data-sum="250"> <a target="_blank" href = "https://www.liqpay.ua/api/3/checkout?data=eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJhbW91bnQiOiIzMDAiLCJjdXJyZW5jeSI6IlVBSCIsImRlc2NyaXB0aW9uIjoiS2luZyBzaXplLCBraW5nIGZlYXR1cmVzIiwicHVibGljX2tleSI6InNhbmRib3hfaTQ5OTIyMDcwMDk2IiwibGFuZ3VhZ2UiOiJydSJ9&signature=rpcjStUkEwn155XN0ARXw5sS6co=">
                <div class="heading">King size, king features</div>
                - 6 month of content access;<br>
                - ability to open all entertainment elements;
                <div class="price">300 UAH</div>
                </a>
                <?php if (@$data[0] >= 250): ?>
                <a target="_blank" href="https://www.liqpay.ua/api/3/checkout?data=eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJhbW91bnQiOiIxODAiLCJjdXJyZW5jeSI6IlVBSCIsImRlc2NyaXB0aW9uIjoiS2luZyBzaXplLCBraW5nIGZlYXR1cmVzIiwicHVibGljX2tleSI6InNhbmRib3hfaTQ5OTIyMDcwMDk2IiwibGFuZ3VhZ2UiOiJydSJ9&signature=iRtPI5UNbvdUkdAceyorFX3X8x4="><button class="discount">Buy with 40% off for 250 points!</button></a>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>