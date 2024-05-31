import { Command as TCommand } from "../api/command/Command";

export const COMMAND_TITLE_FIELD = "id";

export const CommandTitle = (record: TCommand): string => {
  return record.id?.toString() || String(record.id);
};
