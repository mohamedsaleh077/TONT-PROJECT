let keyword = '';

async function populate_data(page, keyword) {
    try {
        const response = await fetch('./includes/list.php?page=' + page + '&keyword=' + keyword, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        const data = await response.text();
        return JSON.parse(data);
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        return {states: []};
    }
}

async function print_table(page, keyword) {
    let array;
    let table = document.getElementById('tableBody');
    let total = document.getElementById('total');
    let pages = document.getElementById("pages")
    array = await populate_data(page, keyword);
    // return array;
    table.innerHTML = ""
    pages.innerHTML = ""
    total.innerHTML = array.total;
    if (array.states.length !== 0) {
        array.states.forEach(element => {
            table.innerHTML += `
            <td>${element.id}</td>
            <td><div id="n${element.id}" contenteditable="true">${element.name}</div></td>
            <td>${element.updated_at}</td>
            <td>${element.created_at}</td>
            <td>
                <a href="./includes/del.php?id=${element.id}" class="action-link"><i class="fa-solid fa-trash"></i></a> | 
                <a onclick="editname(${element.id})" class="action-link"><i class="fa-solid fa-pen"></i></a>
            </td>`;
        })

        let items_per_page = 5;
        let pages_total = Math.ceil(array.total / items_per_page);

        for (let i = 1; i <= pages_total; i++) {
            pages.innerHTML += `<a onclick='print_table(${i}, "${keyword}");'>${i}</a>`;
        }
    } else {
        table.innerHTML = '<td>NO DATA FOUND</td>';
    }
}

async function editname(id)
{
    let name = document.getElementById(`n${id}`).innerText;
    let statues = document.getElementById(`statues`);

    try {
        const response = await fetch('./includes/edit.php?id=' + id + '&name=' + name);
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        const data = await response.text();
        statues.innerHTML = data;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
}

function search(){
    keyword = document.getElementById('keyword').value;
    let cancel = document.getElementById('cancel');
    cancel.style.display = 'inline-block';
    print_table(1, keyword);
}

function gobackagain(){
    document.getElementById('keyword').value = '';
    keyword = '';
    let cancel = document.getElementById('cancel');
    cancel.style.display = 'none';
    print_table(1, keyword);
}

print_table(1, keyword);