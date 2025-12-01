async function get_posts(keyword, page) {

    const requestBody = {
        page: page,
        keyword: keyword,
    };

    try {
        const response = await fetch("/announcement/includes/list.inc.php", {
            method: "POST",
            body: JSON.stringify(requestBody),
            headers: {
                "Content-type": "application/json; charset=UTF-8"
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const json = await response.json();
        return json;

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
                    tag = '<a href="/announcement/uploads/' + post.media + '" target="_blank"><img src="/announcement/uploads/' + post.media + '" alt="post-image"></a>';
                    break;
                case 'video':
                    tag = '<video src="/announcement/uploads/' + post.media + '" controls></video>';
                    break;
                case 'pdf':
                    tag = '<embed src="/announcement/uploads/' + post.media + '" type="application/pdf">';
                    break;
                case 'audio':
                    tag = '<audio src="/announcement/uploads/' + post.media + '" controls></audio>';
                    break;
                default:
                    tag = '';
                    break;
            }
            feed.innerHTML += `
        <div class="evaluation-section post-feed">
                <p class="post-subject">${post.post_subject}</p>
                <p class="post-body">
                    ${post.post_body}
                </p>
                <div class="post-media">
                    ${tag}
                </div>
                <p class="post-metainfo">تم النشر بواسطة: ${post.teacher_name} في ${post.created_at} - ${post.school_name}</p>
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