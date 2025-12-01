let keyword = '';
let state_id = 0;
async function states_data() {
    try {
        const response = await fetch('./includes/list_states.php');
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        const data = await response.text();
        console.log(data);
        return JSON.parse(data);
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        return {states: []};
    }
}

async function print_select() {
    let array;
    let states_list = document.getElementById('state_id');
    let statelist = document.getElementById('statelist');
    array = await states_data();
    if (array.states.length !== 0) {
        array.states.forEach(element => {
            states_list.innerHTML += `<option value="${element.id}">${element.name}</option>`;
            statelist.innerHTML += `<option value="${element.id}">${element.name}</option>`;
        })
    } else {
        states_list.innerHTML = '<option>NO DATA FOUND</option>';
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
    state_id = document.getElementById('statelist').value;
    let cancel = document.getElementById('cancel');
    cancel.style.display = 'inline-block';
    print_table(1, keyword, state_id);
}

function gobackagain(){
    document.getElementById('keyword').value = '';
    keyword = '';
    state_id = 0;
    let cancel = document.getElementById('cancel');
    cancel.style.display = 'none';
    print_table(1, keyword, state_id);
}

print_select();

async function get_schools(page, keyword, state_id) {
    try {
        const response = await fetch('./includes/list.php?page=' + page + '&keyword=' + keyword + '&state_id=' + state_id, {
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
    array = await get_schools(page, keyword, state_id);
    // return array;
    table.innerHTML = ""
    pages.innerHTML = ""
    total.innerHTML = array.total;
    console.log(array);
    if (array.schools.length !== 0) {
        array.schools.forEach(element => {
            table.innerHTML += `
            <td>${element.id}</td>
            <td><div id="n${element.id}" contenteditable="true">${element.name}</div></td>
            <td>${element.state_name}</td>
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

print_table(1, keyword, state_id);