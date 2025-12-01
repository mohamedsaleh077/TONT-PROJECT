async function get_posts(keyword, page) {

    const requestBody = {
        page: page,
        keyword: keyword,
    };

    try {
        const response = await fetch("/community/includes/list_post.inc.php", {
            method: "POST",
            body: JSON.stringify(requestBody),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.json();

    } catch (error) {
        console.error("Error fetching posts:", error);
        return [];
    }
}
let more = document.getElementById("more");
let feed = document.getElementById("feed");
let loadmore = 1;
async function loadPosts(keyword, page) {
    const data = await get_posts(keyword, page);
    console.log(data);
    if (data.posts.length !== 0) {
        data.posts.forEach(post => {
            switch (getFileType(post.media)) {
                case 'image':
                    tag = '<a href="/community/uploads/' + post.media + '" target="_blank"><img src="/community/uploads/' + post.media + '" alt="post-image"></a>';
                    break;
                case 'video':
                    tag = '<video src="/community/uploads/' + post.media + '" controls></video>';
                    break;
                case 'pdf':
                    tag = '<embed src="/community/uploads/' + post.media + '" type="application/pdf">';
                    break;
                case 'audio':
                    tag = '<audio src="/community/uploads/' + post.media + '" controls></audio>';
                    break;
                default:
                    tag = '';
                    break;
            }
            let body = post.post_body.slice(0, 250) + `... <a href="./post.php?id=${post.id}">عرض المنشور بالكامل</a>`;
            feed.innerHTML += `
        <div class="evaluation-section post-feed">
            <div class="post-user">
                <img class="post-pfp" src="/settings/pfps/${post.pfp}" alt="user pfp">
                <div>
                    <p>${post.name} - المرحلة: ${post.grade}</p>
                    <p>${post.created_at}</p>
                </div>
            </div>
                <p class="post-subject">${post.post_subject}</p>
                <p class="post-body">
                    ${body}
                </p>
                <div class="post-media">
                    ${tag}
                </div>
                <p class="post-metainfo">${post.created_at} - ${post.comment_count} <a href="./post.php?id=${post.id}">الردود</a></p>
        </div>
        `
        })

    } else {
        more.innerHTML = `<p>لقد انتهينا! استمتع بوقتك.</p>`;
        loadmore = 0;
    }
}

let images = [
    'jpeg',
    'jpg',
    'png',
    'gif',
    'webp'
];

let videos = [
    'mp4',
    'webm'
];

function getFileType(filename) {
    console.log(filename);
    if (!filename) {
        return 'unknown';
    }
    const fileExtension = filename.split('.').pop().toLowerCase();
    if (images.includes(fileExtension)) {
        return 'image';
    } else if (videos.includes(fileExtension)) {
        return 'video';
    } else if (fileExtension === 'pdf') {
        return 'pdf';
    } else if (fileExtension === 'mp3') {
        return 'audio';
    } else {
        return 'unknown';
    }
}

// console.log(getFileType("test.jpg"));

loadPosts("", 1);

let page = 1;
let search = document.getElementById("search");
let clear = document.getElementById("clear");
let searchBtn = document.getElementById("search-btn");

searchBtn.addEventListener("click", () => {
    feed.innerHTML = "";
    clear.style.display = "inline-block";
    loadmore = 1;
    page = 1;
    loadPosts(search.value, page);
});

clear.addEventListener("click", () => {
    feed.innerHTML = "";
    search.value = "";
    clear.style.display = "none";
    page = 1;
    loadmore = 1;
    more.innerHTML = `<p>تحميل المزيد...</p>`;
    loadPosts("", page);
});



function executeOnPageEnd() {
    if (loadmore === 1) {
        page++;
        loadPosts(search.value, page);
    }
}

window.addEventListener('scroll', function() {
    const scrollPosition = window.innerHeight + window.scrollY;
    const documentHeight = document.documentElement.scrollHeight;
    if (scrollPosition >= documentHeight - 5) { // -5 for a small buffer
        executeOnPageEnd();
    }
});