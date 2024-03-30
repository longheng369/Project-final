import { useEffect, useRef, useState } from "react";

const Textarea = () => {
  const [text, setText] = useState("");
  const textareaRef = useRef(null);

  useEffect(() => {
    const textarea = textareaRef.current;
    if (!textarea) return;
    textarea.style.height = "50px"; // Reset height to ensure correct calculation
    textarea.style.height = textarea.scrollHeight + "px"; // Set to scroll height
  }, [text]);

  const handleChange = (event) => {
    setText(event.target.value);
  };
  return (
    <div className="flex items-start w-11/12">
      <textarea
        ref={textareaRef}
        className="w-[90%] rounded-lg outline-none border-2 shadow-sm resize-none overflow-hidden text-lg p-2 max-h-[200px]"
        placeholder="Type your message here..."
        value={text}
        onChange={handleChange}
      />
      <div className="ml-2 flex-shrink-0">
        <button className="px-4 py-2 rounded-lg bg-blue-500 text-lg whitespace-nowrap text-white">
          Comment
        </button>
      </div>
    </div>
  );
};

export default Textarea;
