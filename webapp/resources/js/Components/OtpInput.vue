<script setup>
import { ref, watch, onMounted } from 'vue';

const props = defineProps({
    length: {
        type: Number,
        default: 6,
    },
    modelValue: {
        type: String,
        default: '',
    },
});

const emit = defineEmits(['update:modelValue', 'finish']);

const digits = ref(new Array(props.length).fill(''));
const inputs = ref([]);

watch(() => props.modelValue, (newVal) => {
    if (newVal !== digits.value.join('')) {
        const chars = newVal.split('');
        for (let i = 0; i < props.length; i++) {
            digits.value[i] = chars[i] || '';
        }
    }
}, { immediate: true });

const handleInput = (index, event) => {
    const value = event.target.value;
    
    if (!/^\d*$/.test(value)) {
        digits.value[index] = '';
        return;
    }

    digits.value[index] = value.slice(-1);

    if (value && index < props.length - 1) {
        inputs.value[index + 1].focus();
    }

    emitValue();
};

const handlePaste = (event) => {
    event.preventDefault();
    const pastedData = event.clipboardData.getData('text').replace(/\D/g, '').slice(0, props.length);
    
    for (let i = 0; i < pastedData.length; i++) {
        digits.value[i] = pastedData[i];
    }
    
    emitValue();
    
    const nextIndex = Math.min(pastedData.length, props.length - 1);
    inputs.value[nextIndex]?.focus();
};

const handleKeydown = (index, event) => {
    if (event.key === 'Backspace' && !digits.value[index] && index > 0) {
        inputs.value[index - 1].focus();
    }
};

const emitValue = () => {
    const code = digits.value.join('');
    emit('update:modelValue', code);
    
    if (code.length === props.length) {
        emit('finish', code);
    }
};

onMounted(() => {
    // Auto focus first input
    if (inputs.value[0]) {
        inputs.value[0].focus();
    }
});
</script>

<template>
    <div class="d-flex gap-4 justify-center otp-container">
        <input
            v-for="(digit, index) in digits"
            :key="index"
            ref="inputs"
            type="text"
            inputmode="numeric"
            maxlength="1"
            class="otp-input"
            :value="digit"
            @input="(e) => handleInput(index, e)"
            @keydown="(e) => handleKeydown(index, e)"
            @paste="handlePaste"
        />
    </div>
</template>

<style scoped lang="scss">
.otp-container {
    gap: 12px;
}

.otp-input {
    width: 48px;
    height: 56px;
    font-size: 24px;
    font-weight: 600;
    text-align: center;
    border: 1px solid #E0E0E0;
    border-radius: 8px;
    background-color: white;
    transition: all 0.2s ease;
    color: #333;

    &:focus {
        border-color: #1867C0; // Primary color
        box-shadow: 0 0 0 2px rgba(24, 103, 192, 0.2);
        outline: none;
    }

    &:hover {
        border-color: #BDBDBD;
    }
}
</style>
