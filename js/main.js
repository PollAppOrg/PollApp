console.log("hello");

let list = document.querySelector(".top-trending");

window.onload = async () => {
    let polls = await fetchTrendingPolls();
    polls = polls.slice(0,5)
    console.log(polls);
    let tmp = '';
    
    polls.forEach(function(poll, i) {
        let extra = '';
        let extra1 = '';

        if(i == 0) {
            extra = 'primary-color text-white'
            extra1 = 'text-pop2 font-size-2 font-weight-bold';
        }

        if(i == 1) {
            extra1 = 'text-pop font-size-15 font-weight-bold';
        }

        tmp += ` <li class="list-group-item d-flex align-items-center justify-content-between border-top-0 border-left-0 border-right-0 ${extra}">
                    <p class="index mb-0 ${extra1}">#${i + 1}</p>
                    <h4 class="title mb-0">${poll['title'].substring(0,50)}</h4>
                    <p class="vote mb-0">${poll['vote_1'] + poll['vote_2']}</p>
                    <a href="<?=ROOT?>/poll/get/${poll['id']}" class="btn btn6">Go to poll</a>
                </li>`;
    })

    list.innerHTML += tmp;
}

async function fetchTrendingPolls() {
    let polls = await fetch("poll/trending")
                .then(res => res.json())
                .then(data => data);
    return polls;
}