# Emotion-Recognition-and-Mental-Health-Analyzer

Certainly, let's provide more detailed explanation of each part of the code:

**1. Import Libraries:**
   - The code imports necessary libraries for various tasks:
     - `sys` is used for handling command-line arguments (although it's not used in the provided code snippet).
     - `cv2` (OpenCV) is a powerful library for image and video processing.
     - `numpy` (NumPy) is used for numerical operations.
     - `load_model` from TensorFlow/Keras loads a pre-trained deep learning model.
     - `img_to_array` is used to convert images to NumPy arrays.

**2. Load Haar Cascade Classifier and Emotion Recognition Model:**
   - The code loads two essential components:
     - `face_classifier`: A pre-trained Haar Cascade Classifier for detecting faces in images or video frames.
     - `classifier`: A pre-trained deep learning model for recognizing emotions in facial expressions.

**3. Define Emotion Labels:**
   - A list called `emotion_labels` is defined. It contains strings representing various emotions such as 'Angry,' 'Disgust,' 'Fear,' 'Happy,' 'Neutral,' 'Sad,' and 'Surprise.' These labels correspond to the possible recognized emotions.

**4. Capture Video:**
   - The code initializes video capture from the default camera (usually the webcam) using OpenCV's `VideoCapture` object. The parameter `0` typically represents the default camera.

**5. Initialize Counters:**
   - The code initializes three counters:
     - `i`: This counter keeps track of the total number of frames processed.
     - `happy`: It counts the occurrences of the 'Happy' emotion.
     - `anger`: It counts the occurrences of the 'Angry' emotion.

**6. Real-Time Video Analysis (Inside the While Loop):**
   - The code enters a continuous loop, which ensures that video frames are processed in real-time.

**7. Read Video Frames:**
   - Inside the loop, the code captures video frames from the webcam or video source. These frames are stored in the variable `frame`.

**8. Face Detection:**
   - The code converts the current frame to grayscale using `cv2.cvtColor`. Grayscale images are often used for face detection to simplify processing.
   - It employs the Haar Cascade Classifier (`face_classifier`) to detect faces in the grayscale frame. Detected faces are represented as rectangles.

**9. Emotion Recognition (Inside the Face Detection Loop):**
   - For each detected face:
     - The code extracts the region of interest (ROI) from the grayscale frame. This ROI represents the detected face.
     - The ROI is resized to a consistent size (48x48 pixels) using `cv2.resize`.
     - Preprocessing is applied to prepare the ROI for model prediction.
     - The deep learning model (`classifier`) predicts the dominant emotion for the ROI.
     - The recognized emotion label is stored in the variable `label`.

**10. Update Emotion Counters:**
    - The code updates various counters based on the recognized emotion:
      - `i` is incremented to count the total frames processed.
      - `happy` and `anger` counters are updated to count the occurrences of 'Happy' and 'Angry' emotions, respectively.

**11. Display Emotion Labels:**
    - The code overlays the recognized emotion label on the video frame using `cv2.putText`.

**12. Display Video Frame:**
    - The analyzed video frame with the overlaid emotion label is displayed in a window titled 'Emotion Detector' using `cv2.imshow`.

**13. Exit the Loop:**
    - The loop can be exited by pressing the 'q' key. When this happens, the code calculates and returns the ratio of 'Happy' emotions to the total number of frames processed.

**14. Clean Up Resources:**
    - After the loop exits, the code releases the video capture object (`cap`) to free up system resources.
    - OpenCV windows are closed and any remaining resources are released with `cv2.destroyAllWindows()` and `cv2.waitKey(1)`.

In summary, this code creates a real-time emotion recognition system that processes video frames from a webcam, detects faces, recognizes emotions, and counts the occurrences of 'Happy' and 'Angry' emotions. The result returned is the ratio of 'Happy' emotions to the total frames processed when the 'q' key is pressed.
