(function () {
  const btnNewFeedModal = document.querySelector('#btnNewFeedModal');
  if (btnNewFeedModal) {
    const newFeedModal = document.querySelector('#newFeedModal');
    const body = newFeedModal.querySelector('#id-modal-body');
    const frmElms = newFeedModal.querySelector('form');
    console.log(frmElms.imgs);
    frmElms.imgs.addEventListener('change', (e) => {
      if (frmElms.imgs.files.length > 0) {
        body.innerHTML = `
          <div>
            <div class="d-flex flex-md-row">
              <div class="flex-grow-1 h-full"><img id="id-img" class="w300"></div>
              <div class="ms-1 w250 d-flex flex-column">
                <textarea placeholder="문구 입력..." class="flex-grow-1 p-1"></textarea>
                <input type="text" placeholder="위치" class="mt-1 p-1">
              </div>
            </div>
          </div>
          <div class="mt-2">
            <button type="button" class="btn btn-primary">공유하기</button>
          </div>
          `;
      }
      const denoteImg = document.querySelector('#id-img');

      const findImg = frmElms.imgs.files[0];

      const reader = new FileReader();
      reader.readAsDataURL(findImg);
      reader.onload = function () {
        denoteImg.src = reader.result;
      };
    });

    // 컴퓨터에서 찾기 버튼만들고 클릭시 input type:file 실행
    btnNewFeedModal.addEventListener('click', (e) => {
      const button = document.createElement('button');
      button.type = 'button';
      button.className = 'btn btn-primary';
      button.innerText = '컴퓨터에서 찾기';

      button.addEventListener('click', (e) => {
        frmElms.imgs.click();
      });
      body.innerText = null;
      body.appendChild(button);
    });
  }
})();

// body.innerHTML = `
// <div>
//   <div class="d-flex flex-md-row">
//     <div class="flex-grow-1 h-full"><img id="id-img" class="w300"></div>
//     <div class="ms-1 w250 d-flex flex-column">
//       <textarea placeholder="문구 입력..." class="flex-grow-1 p-1"></textarea>
//       <input type="text" placeholder="위치" class="mt-1 p-1">
//     </div>
//   </div>
// </div>
// <div class="mt-2">
//   <button type="button" class="btn btn-primary">공유하기</button>
// </div>
// `;
