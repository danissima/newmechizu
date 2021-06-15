let modal = $('.words__modal');
let modalOpenBtn = $('.word-change');
let modalCloseBtn = $('.modal__close');
let modalOverlay = $('.modal__overlay');

modalOpenBtn.on('click', (e) => {
  modal.css('display', 'flex');
  let thisWordId = e.currentTarget.parentElement.children[0].value;
  let thisWordFrom = e.currentTarget.parentElement.children[1].value;
  let thisWordKanji = e.currentTarget.parentElement.children[2].innerHTML;
  let thisWordKana = e.currentTarget.parentElement.children[3].innerHTML;
  let thisWordTranslate = e.currentTarget.parentElement.children[4].innerHTML;

  let modalId = $('.wordId')
  let modalFrom = $('.from')
  let modalKanji = $('.wordKanji')
  let modalKana = $('.wordKana')
  let modalTranslate = $('.wordTranslate')

  modalId.attr('value', thisWordId);
  modalFrom.attr('value', thisWordFrom);
  modalKanji.attr('value', thisWordKanji);
  modalKana.attr('value', thisWordKana);
  modalTranslate.attr('value', thisWordTranslate);

  $('body').css('overflow', 'hidden')
})

modalCloseBtn.on('click', () => {
  modal.css('display', 'none');
  $('body').css('overflow', '')
})

modalOverlay.on('click', () => {
  modal.css('display', 'none');
  $('body').css('overflow', '')
})