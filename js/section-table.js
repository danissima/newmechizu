let addButtons = $('.section__table-row-add');
let removeButtons = $('.section__table-row-delete');
let table = $('.js-table');
let row = $('.js-row');

addButtons.on('click', () => {
    let newRow = row.clone()[0];
    for (let i = 0; i < newRow.children.length; i++) {
        newRow.children[i].value = '';
    }
    table.append(newRow)
    $(newRow).find('span').on('click', (e) => { removeFromTable(e) })
})

removeButtons.on('click', (e) => { removeFromTable(e) })

function removeFromTable(e) {
    if (e.currentTarget.parentElement.parentElement.children.length > 2) {
        e.currentTarget.parentElement.remove();
    } else {
        for (let i = 0; i < e.currentTarget.parentElement.children.length; i++) {
            if (e.currentTarget.parentElement.children[i].type !== 'hidden') {
                e.currentTarget.parentElement.children[i].removeAttribute('value')
                e.currentTarget.parentElement.children[i].value = ''
            }
        }
    }
}