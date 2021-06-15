let addReadingBtn = $('.add-kanji__reading-add');
let removeReadingBtn = $('.add-kanji__reading-delete');

addReadingBtn.on('click', (e) => {
  let thisReadingsWp = e.currentTarget.parentElement.parentElement.children[1];
  let thisReadingsRow = $(thisReadingsWp).find('.add-kanji__reading-row')[1];
  let newRow = $(thisReadingsRow).clone()[0];
  for (let i = 0; i < newRow.children.length; i++) {
    newRow.children[i].value = '';
  }
  thisReadingsWp.append(newRow);
  $(newRow).find('span').on('click', (e) => { removeFromTable(e) })
})

removeReadingBtn.on('click', (e) => { removeFromTable(e) })

function removeFromTable(e) {
  if (e.currentTarget.parentElement.parentElement.children.length > 2) {
    e.currentTarget.parentElement.remove();
  } else {
    for (let i = 0; i < e.currentTarget.parentElement.children.length; i++) {
      if (e.currentTarget.parentElement.children[i].type !== 'hidden') {
        // e.currentTarget.parentElement.children[i].removeAttribute('value')
        e.currentTarget.parentElement.children[i].value = ''
      }
    }
  }
}