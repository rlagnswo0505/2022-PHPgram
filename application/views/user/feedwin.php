<div class="d-flex flex-column align-items-center">
    <div class="size_box_100"></div>
    <div class="w100p_mw614">
        <div class="d-flex flex-row">            
            <div class="d-flex flex-column justify-content-center me-3">
                <div class="circleimg h150 w150 pointer feedwin">
                    <img class="feedwin-profile"   data-bs-toggle="modal" data-bs-target="#changeProfileModal"src='/static/img/profile/<?=$this->data->iuser?>/<?=$this->data->mainimg?>' onerror='this.error=null;this.src="/static/img/profile/defaultProfileImg_100.png"'>
                </div>
            </div>

            <div class="flex-grow-1 d-flex flex-column justify-content-between">
              <div>아이디</div>
              <div class="d-flex flex-row">
                <div class="flex-grow-1">게시물 <span>18</span></div>
                <div class="flex-grow-1">팔로워 <span>18</span></div>
                <div class="flex-grow-1">팔로우 <span>18</span></div>
              </div>
              <div class="bold">이름</div>
              <div>상태메시지(cmt)</div>
            </div>
        </div>
    </div>
</div>
<!-- change profile Modal -->
<div class="modal fade" id="changeProfileModal" tabindex="-1" aria-labelledby="changeProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content w400" id="changeProfileModalContent">
            <div class="modal-header justify-content-center">
            <h5 class="modal-title bold">프로필 사진 바꾸기</h5>
            </div>
            <div class="modal-body pointer">
            <p class="blue bold">사진 업로드</p>
            </div>
            <div class="modal-body pointer">
            <p class="red bold">현재 사진 삭제</p>
            </div>
            <div class="modal-body pointer" data-bs-dismiss="modal" aria-label="Close">
            <p>취소</p>
            </div>
        </div>
    </div>
</div>