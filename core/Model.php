<?php
abstract class Model
{
    protected array $VALUES = [];
    private static ?PDO $db = null;

    public function __get(string $key): mixed
    {
        return $this->VALUES[$key] ?? null;
    }

    public function __set(string $key, mixed $value): void
    {
        $this->VALUES[$key] = $value;
    }

    public function __isset(string $key): bool
    {
        return isset($this->VALUES[$key]);
    }

    protected static function tableName(): string
    {
        return strtolower(static::class) . 's';
    }

    public function save(): void
    {
        $fields = array_diff_key($this->VALUES, ['id' => null]);

        if (empty($fields)) {
            return;
        }

        $set    = implode(', ', array_map(fn($col) => "`{$col}` = ?", array_keys($fields)));
        $values = [...array_values($fields), $this->VALUES['id']];

        static::execute(
            'UPDATE `' . static::tableName() . '` SET ' . $set . ' WHERE `id` = ?',
            $values
        );
    }

    protected static function execute(string $sql, array $params = []): void
    {
        if (self::$db === null) {
            self::$db = Database::getInstance();
        }
        self::$db->prepare($sql)->execute($params);
    }

    protected static function query(string $sql, array $params = [], bool $single = false): array|static|false
    {
        if (self::$db === null) {
            self::$db = Database::getInstance();
        }

        $stmt = self::$db->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();

        if ($single) {
            if (empty($rows)) {
                return false;
            }
            $obj = new static();
            foreach ($rows[0] as $col => $val) {
                $obj->$col = $val;
            }
            return $obj;
        }

        return array_map(function (array $row): static {
            $obj = new static();
            foreach ($row as $col => $val) {
                $obj->$col = $val;
            }
            return $obj;
        }, $rows);
    }
}
