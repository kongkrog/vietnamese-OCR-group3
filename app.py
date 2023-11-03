import streamlit as st
import requests

# Define the endpoint URL
endpoint = "http://localhost:8001/predict"  # Replace with your API endpoint

# Create the Streamlit app
def main():
    st.title("Image Text Recognition")
    st.write("Upload an image to predict the text")

    # Upload image file
    uploaded_file = st.file_uploader("Choose an image", type=["jpg", "jpeg", "png"])

    if uploaded_file is not None:
        # Display the uploaded image
        st.image(uploaded_file, caption="Uploaded Image", use_column_width=True)

        # Make the prediction request to the API endpoint
        response = requests.post(endpoint, files={"image": uploaded_file})

        # Check if the request was successful
        if response.status_code == 200:
            # Get the predicted text from the response
            predicted_text = response.json().get("predicted_text")

            # Display the predicted text
            st.subheader("Predicted Text:")
            st.write(predicted_text)
        else:
            st.error("Error predicting text. Please try again.")

# Run the app
if __name__ == "__main__":
    main()