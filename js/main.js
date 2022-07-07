console.log("hello");

let list = document.querySelector(".top-trending");
let list2 = document.querySelector(".top-trending-2");
let btn = document.querySelector(".view-trending");
let polls = [];

window.onload = async () => {
    polls = await fetchTrendingPolls();
    polls = polls.slice(0,5)
    let tmp = loadPollsToUI();
    if(list != null) {
        list.innerHTML += tmp;
    }
    if(list2 != null) {
        list2.innerHTML = `<li class="list-group-item d-flex justify-content-between border-top-0 border-left-0 border-right-0">
                                <h4 class="index">Index</h4>
                                <h4 class="title">Title</h4>
                                <h4 class="vote">Votes</h4>
                                <h4 class="link">Go to Poll</h4>
                            </li>` + tmp;
        list2.style.display = 'none';
    }
}

btn.addEventListener('click', function() {
    if(list2.style.display != 'none') {
        btn.innerHTML = `<i class="fa fa-eye" aria-hidden="true"></i> View Top Trending Polls`;
        list2.style.display = 'none';
        return;
    }

    btn.innerHTML = `<i class="fa fa-close" aria-hidden="true"></i> Close`;
    list2.style.display = 'block';    
})

function loadPollsToUI() {
    let tmp = '';
    polls.forEach(function(poll, i) {
        let extra = '';
        let extra1 = '';

        if(i == 0) {
            extra = 'primary-color text-white'
            extra1 = 'text-pop2 font-size-2 font-weight-bold';
        }

        if(i == 1) {
            extra = 'secondary-color text-white'
            extra1 = 'text-pop font-size-15 font-weight-bold';
        }

        tmp += ` <li class="list-group-item d-flex align-items-center justify-content-between border-top-0 border-left-0 border-right-0 ${extra}">
                    <p class="index mb-0 ${extra1}">#${i + 1}</p>
                    <h4 class="title mb-0 ${extra1}">${poll['title'].substring(0,50)}</h4>
                    <p class="vote mb-0 ${extra1}">${poll['vote_1'] + poll['vote_2']}</p>
                    <a href="<?=ROOT?>poll/get/${poll['id']}" class="btn btn6">Go to poll</a>
                </li>`;
    })
    return tmp;
}

async function fetchTrendingPolls() {
    let polls = await fetch("poll/trending")
                .then(res => res.json())
                .then(data => data);
    return polls;
}