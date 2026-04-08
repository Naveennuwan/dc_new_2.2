<div class="row justify-content-center">
    <div class="form-group col-10 col-sm-10">
    @if(count($images))
    <button type="button" class="modern-btn btn-aqua bulk-image-btn" >Send All</button>
    <div class="row">

        @foreach ($images as $key => $image)
        <div class="col-6 col-sm-4 col-md-3 image-container">
          <div class="image-card">
              <img
                  id="products_other_image_{{ $image->id }}"
                  class="images-size image-clickable"
                  src="{{ asset('images/patient_images/'. $image->patient_id .'/'. $image->image) }}"
                  data-index="{{ $key }}"
              />

              <div class="button-row">
                  <button type="button"
                          class="modern-btn btn-coral delete-image"
                          data-toggle="modal"
                          data-target="#deleteModal"
                          data-image-id="{{ $image->id }}">
                      Delete
                  </button>

                  <button type="button"
                          class="modern-btn btn-aqua send-image-btn"
                          data-image-id="{{ $image->id }}">
                      Send
                  </button>
              </div>
          </div>
      </div>
              
      <form id="deleteForm_{{ $image->id }}" action="{{ route('image.delete', $image->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
        @endforeach
    </div>
    <br>
    @endif

    </div>
</div>

<!--Image View Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-dark text-center">
            <div class="modal-body">
                <img id="previewImage" src="" class="img-fluid" style="max-height:80vh"/>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" id="prevBtn">Previous</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary" id="nextBtn">Next</button>
            </div>
        </div>
    </div>
</div>

<!--Image Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mb-0">Delete Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-2">Are you sure you want to delete this image?</p>
        <img id="deletePreview" src="" class="img-fluid" style="max-height:40vh" alt="Delete preview"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
      </div>
    </div>
  </div>
</div>

@push('css')
<style>/* ===============================
   IMAGE GRID ITEM
================================ */
.image-container {
    margin-bottom: 16px; /* spacing between rows */
    text-align: center;
}

/* Card wrapper */
.image-card {
    background: #ffffff;
    padding: 12px;
    border-radius: 14px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
}

/* ===============================
   IMAGE THUMBNAIL
================================ */
.images-size {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 10px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.images-size:hover {
    transform: scale(1.04);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
}

/* ===============================
   BUTTON ROW
================================ */
.button-row {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 12px;
}

.button-row .modern-btn {
    flex: 1;
    font-size: 13px;
    padding: 6px 10px;
    white-space: nowrap;
}

/* ===============================
   IMAGE PREVIEW MODAL
================================ */
#imagePreviewModal .modal-content {
    background-color: #000;
    border-radius: 14px;
}

#imagePreviewModal img {
    max-height: 80vh;
    max-width: 100%;
    object-fit: contain;
    border-radius: 10px;
}

/* ===============================
   DELETE MODAL IMAGE
================================ */
#deletePreview {
    max-height: 250px;
    width: 100%;
    object-fit: contain;
    border-radius: 8px;
}

/* ===============================
   RESPONSIVE ADJUSTMENTS
================================ */
@media (max-width: 992px) {
    .images-size {
        height: 160px;
    }
}

@media (max-width: 768px) {
    .images-size {
        height: 140px;
    }

    .button-row {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    .images-size {
        height: 130px;
    }
}

</style>
@endpush



@push('js')
<script>
$(document).on('click', '.send-image-btn', function () {
    const imageId = $(this).data('image-id');
    
    const patientId = document.getElementById('patient_id').value;
    
    if (patientId) {
      const route = `/image-sms/${patientId}/${imageId}`;
      window.location.href = route; 
    } else {
      alert('Select a patient first');
    }
  });

  $(document).on('click', '.bulk-image-btn', function () {
    
    const patientId = document.getElementById('patient_id').value;

    console.log(patientId)
    
    if (patientId) {
      const route = `/bulk-image-sms/${patientId}`;
      window.location.href = route; 
    } else {
      alert('Select a patient first');
    }
  });

$(document).ready(function() {
        $("#main-image-upload").on("change", function() {
            $("#delete-main-flag").val('0');
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $("#image-preview-area").attr("src", e.target.result);
                };
                
                reader.readAsDataURL(input.files[0]);
            }
        });
        
        $("#main-image-delete").on("click", function(e) {
            e.preventDefault();
            $("#image-preview-area").attr("src", "");
            $("#image-preview-area").val('');
            $("#delete-main-flag").val('1');
        });
    });
    
    $(document).ready(function() {
        $('#save_image_upload_btn').on('click', function() {
            const formData = new FormData($('#imageUploadForm')[0]);
            $('#imageUploadForm').submit();
        });
    });
  document.addEventListener("DOMContentLoaded", function () {
    // ===== Image Preview Modal (with Next/Prev) =====
    const images = Array.from(document.querySelectorAll(".image-clickable"));
    const previewImage = document.getElementById("previewImage");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    let currentIndex = 0;

    function updatePreviewModal(index) {
      previewImage.src = images[index].src;
      currentIndex = index;
      prevBtn.style.display = (index === 0) ? "none" : "inline-block";
      nextBtn.style.display = (index === images.length - 1) ? "none" : "inline-block";
    }

    images.forEach((img, index) => {
      img.addEventListener("click", function () {
        updatePreviewModal(index);
        $("#imagePreviewModal").modal("show");
      });
    });

    prevBtn.addEventListener("click", function () {
      if (currentIndex > 0) updatePreviewModal(currentIndex - 1);
    });

    nextBtn.addEventListener("click", function () {
      if (currentIndex < images.length - 1) updatePreviewModal(currentIndex + 1);
    });

    // Optional: keyboard navigation while preview modal is open
    document.addEventListener("keydown", function (e) {
      if (!$("#imagePreviewModal").hasClass("show")) return;
      if (e.key === "ArrowLeft" && currentIndex > 0) updatePreviewModal(currentIndex - 1);
      if (e.key === "ArrowRight" && currentIndex < images.length - 1) updatePreviewModal(currentIndex + 1);
      if (e.key === "Escape") $("#imagePreviewModal").modal("hide");
    });

    // ===== Delete Modal + Submit Hidden Form =====
    let imageIdToDelete = null;

    // When user clicks Delete button under a thumbnail
    $(document).on("click", ".delete-image", function () {
      imageIdToDelete = $(this).data("image-id");

      // Show a small preview inside the delete modal (nice UX)
      const imgEl = document.getElementById("products_other_image_" + imageIdToDelete);
      const delPrev = document.getElementById("deletePreview");
      if (imgEl && delPrev) delPrev.src = imgEl.src;
    });

    // Confirm delete -> submit the hidden form
    $("#confirmDeleteBtn").on("click", function () {
      if (!imageIdToDelete) return;

      const form = document.getElementById("deleteForm_" + imageIdToDelete);
      if (form) {
        form.submit(); // standard POST with _method=DELETE
      }
    });

    // Clear selected id when modal is closed
    $("#deleteModal").on("hidden.bs.modal", function () {
      imageIdToDelete = null;
      const delPrev = document.getElementById("deletePreview");
      if (delPrev) delPrev.src = "";
    });
  });
</script>
@endpush