def calculate_cer(hypothesis, reference):
    S, D, I, C = 0, 0, 0, 0

    for i in range(len(hypothesis)):
        if i < len(reference):
            if hypothesis[i] == reference[i]:
                C += 1
            else:
                S += 1  # Substitution
        else:
            D += 1  # Deletion

    I = len(reference) - C  # Insertion

    cer = (S + D + I) / (S + D + C) if (S + D + C) > 0 else 0

    return cer, S, D, I, C

# Example usage
hypothesis_text = "hello world"
reference_text = "hola world"
cer_value, substitutions, deletions, insertions, correct_chars = calculate_cer(hypothesis_text, reference_text)

print(f"CER: {cer_value * 100:.2f}%")
print(f"Substitutions (S): {substitutions}")
print(f"Deletions (D): {deletions}")
print(f"Insertions (I): {insertions}")
print(f"Correct Characters (C): {correct_chars}")
