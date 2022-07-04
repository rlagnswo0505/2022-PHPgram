(function () {
  const btnFollow = document.querySelector('#btnFollow');
  btnFollow.addEventListener('click', () => {
    const url = new URL(window.location.href);
    if (btnFollow.innerText === '팔로우' || btnFollow.innerText === '맞팔로우 하기') {
      fetch(`http://localhost/user/follow${window.location.search}`, {
        method: 'POST',
      })
        .then((res) => res.json())
        .then((data) => {
          btnFollow.setAttribute('data-follow', 1);
          btnFollow.className = 'btn btn-outline-secondary';
          btnFollow.innerText = '팔로우 취소';
        });
    } else if (btnFollow.innerText === '팔로우 취소') {
      fetch(`http://localhost/user/follow${window.location.search}`, {
        method: 'DELETE',
      })
        .then((res) => res.json())
        .then((data) => {
          btnFollow.setAttribute('data-follow', 0);
          btnFollow.className = 'btn btn-primary';
          if (Number(btnFollow.getAttribute('data-both-follow')) === 1) {
            btnFollow.innerText = '맞팔로우 하기';
          } else {
            btnFollow.innerText = '팔로우';
          }
        });
    }
  });
})();
