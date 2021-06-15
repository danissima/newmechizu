let radicalModal = $('.radicals__modal');
let radicalModalOpenBtn = $('.radical-change');
let radicalModalCloseBtn = $('.modal__close');
let radicalModalOverlay = $('.modal__overlay');

radicalModalOpenBtn.on('click', (e) => {
  radicalModal.css('display', 'flex');
  let thisRadicalId = e.currentTarget.parentElement.children[0].value;
  let thisRadicalKanji = e.currentTarget.parentElement.children[1].innerHTML;
  let thisRadicalKana = e.currentTarget.parentElement.children[2].innerHTML;
  let thisRadicalTranslate = e.currentTarget.parentElement.children[3].innerHTML;

  let modalId = $('.radicalId')
  let modalView = $('.radicalView')
  let modalNum = $('.radicalNum')
  let modalName = $('.radicalName')

  modalId.attr('value', thisRadicalId);
  modalView.attr('value', thisRadicalKanji);
  modalNum.attr('value', thisRadicalKana);
  modalName.attr('value', thisRadicalTranslate);

  $('body').css('overflow', 'hidden')
})

radicalModalCloseBtn.on('click', () => {
  radicalModal.css('display', 'none');
  $('body').css('overflow', '')
})

radicalModalOverlay.on('click', () => {
  radicalModal.css('display', 'none');
  $('body').css('overflow', '')
})