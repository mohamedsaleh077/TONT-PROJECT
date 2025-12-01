
let postid = window.location.href.split("=")[1];

async function getPost(postid) {

    const requestBody = {
        post_id: postid
    };

    try {
        const response = await fetch("/community/includes/post_details.inc.php", {
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
    console.log(fileExtension);
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

const postHTML = document.getElementById("post");
const commentHTML = document.getElementById("comments");
async function data() {
    const data = await getPost(postid);
    let post = data.post[0];
    console.log(post)
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
    if (post.pfp === null){
        post.pfp = 'default.jpg'
    }
    let body = marked.parse(post.post_body)

        postHTML.innerHTML = `
                <div class="main-content">
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
                </div>
    `;

    console.log(data.comments);
    data.comments.forEach(post => {
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
        body = marked.parse(post.comment_text)
        if (post.profile_picture === null){
            post.profile_picture = 'default.jpg'
        }
        commentHTML.innerHTML += `
        <div class="comment-section">
            <div class="post-user">
                <img class="post-pfp" src="/settings/pfps/${post.profile_picture}" alt="user pfp">
                <div>
                    <p>${post.fullname} - المادة: ${post.subject}</p>
                    <p>${post.created_at}</p>
                </div>
            </div>
            <p class="post-body">
                ${body}
            </p>
            <div class="post-media">
                ${tag}
            </div>
        </div>
        `

    })
}

data()
window.location.reload();
